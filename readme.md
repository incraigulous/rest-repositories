# Rest Repositories

Fetch data from any rest API with a common interface.

### In a nutshell
You should be able to fetch data from ANY webservice using the following API: 

```
	$posts = PostsRepository::all();
```
or 

```
	$post = PostsRepository::find(1);
```

This keeps you from having to create a separate mental map for each web service you work with. 

## Repositories
It's the job of the repository to abstract working with your webservice to a common interface. Extend `Incraigulous\RestRepositories\Single`, `Incraigulous\RestRepositories\Listing` or `Incraigulous\RestRepositories\Resource` for minimal setup.


### Resources
A resource is for API resources with full read/write capability. The resource object has the following methods: 

```
	public static function get($params = []);
	public static function update($id, $params = []);
	public static function all();
	public static function find($id);
	public static function create($payload);
	public static function delete($payload);
```

To create a new resource extend `Incraigulous\RestRepositories\Resource`: 

For example: 

```php
    use Incraigulous\RestRepositories\Resource;
    class PostsResource extends Resource
    {
        static $resource = 'posts'
        public static function sdk() {
            return new YourSdk();
        }
    }
```

### Listings
   A listing is for API resources with full read only capability. The resource object has the following methods: 
   
   ```
   	public static function get($params = []);
   	public static function all();
   	public static function find($id);
   ```
   
   To create a new listing extend `Incraigulous\RestRepositories\Listing`: 


   
### Singles
A single is for API resources for a single listing endpoint. The resource object has only the `get` method.: 

```
	public static function get($params = []);
```

To create a new single extend `Incraigulous\RestRepositories\Single`: 



    
### Creating a base repository for a webservice
```
	//This is just an example, you should create your own SDK implementation
	use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk; 
	
	use Incraigulous\RestRepositories\Listing;
	
	class JsonPlaceholderBaseRepository extends Listing
	{
	    public static function sdk() {
	        return new JsonPlaceholderSdk();
	    }
	}
```

### Creating a repository
```
	class JsonPlaceholderPostsRepository extends JsonPlaceholderBaseRepository
	{
	    public static $resource = 'posts';
	}
	
	$posts = JsonPlaceholderPostsRepository::all();
    
```

### Getting the original data
Responses are wrapped in Collection and Object wrappers by default and data keys are stripped out. To access response meta data like pagination or links, you can retrieve the original object like so:
```
    PostRepository::all()->getOriginal()['page'];
    //Or
    PostRepository::all()->first()->getOriginal()['links'];
    //Or
    PostRepository::all()->first()->author->getOriginal()['links'];
```

## SDKs
It's the job of an SDK class to make requests to a webservice. SDKs should implement `Incraigulous\RestRepositories\Contracts\SdkInterface`. To make this easy, a base `Incraigulous\RestRepositories\Sdks\HttpSdk` class is provided.

### Using the HttpSdk class on the fly
#### Without authentication

```
	$sdk = new HttpSdk('https://jsonplaceholder.typicode.com/');
	$result = $sdk->post('posts', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);

```

#### With authentication

```
	$sdk = new HttpSdk('http://example.com/api/', ['headers' => ['Authorization' => 'password123']]);
	$result = $sdk->post('posts', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);

```

### Even Better: Creating your own SDK class
#### Without authentication
```
	<?php
	use Incraigulous\RestRepositories\Sdks\HttpSdk;
	
	class JsonPlaceholderSdk extends HttpSdk
	{
	    protected $endpoint = 'https://jsonplaceholder.typicode.com/';
	}
	
	$sdk = new JsonPlaceholderSdk();
	$result = $sdk->post('posts', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);
```

#### With authentication

```
	<?php
	use Incraigulous\RestRepositories\Sdks\HttpSdk;
	
	class ExampleSdk extends HttpSdk
	{
	    protected $endpoint = 'http://example.com/api/';
	    
	    protected function defaultHeaders()
	    {
	    	return ['Authorization' => $however->you->get->api->key];
	    }
	}
	
	$sdk = new ExampleSdk();
	$result = $sdk->post('posts', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);
```

## Testing
```
	/vendor/bin/phpunit
```	
