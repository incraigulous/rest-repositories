# Rest Repositories

Fetch data from any rest API with a common interface.

### In a nutshell
You should be able to fetch data from ANY webservice using the following API: 

```
	$repo = new PostsRepository();
	$posts = $repo->all();
```
or 

```
	$repo = new PostsRepository();
	$post = $repo->find(1);
```

This keeps you from having to create a seperate mental map for each web service you work with. 

## Repositories
It's the job of the repository to abstract working with your webservice to a common interface. Providing an instance of `Incraigulous\RestRepositories\Contracts\SdkInterface` will allow you to extend `Incraigulous\RestRepositories\BaseRepository` for minimal setup. You are also free to implement `Incraigulous\RestRepositories\Contracts\RepositoryInterface` if you want to use your webservice's out-of-the-box SDK library.  

### Repository methods:
```
	public function get($params = []);
	public function update($id, $params = []);
	public function all();
	public function find($id);
	public function create($payload);
	public function delete($payload);
```
    
### Creating a base repository for a webservice
```
	//This is just an example, you should create your own SDK implementation
	use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk; 
	
	use Incraigulous\RestRepositories\BaseRepository;
	
	class JsonPlaceholderBaseRepository extends BaseRepository
	{
	    public function setup() {
	        $this->sdk = new JsonPlaceholderSdk();
	    }
	}
```

### Creating a repository
```
	class JsonPlaceholderPostsRepository extends JsonPlaceholderBaseRepository
	{
	    public $resource = 'posts';
	}
	
	$repo = new JsonPlaceholderPostsRepository();
	$posts = $repo->all();
    
```

### Caching
You can cache your requests by using the `Incraigulous\RestRepositories\Cacheable` trait. This works with Laravel's built in cache class. If you don't use Laravel, you can implement `Incraigulous\RestRepositories\Contracts\CacheableInterface` in your base repository. 

```
	import Incraigulous\RestRepositories\Cacheable;
	
	class JsonPlaceholderPostsRepository extends JsonPlaceholderBaseRepository
	{
		 use Cacheable;
	
		protected $cacheTime = 10; //How long to cache.
	    protected $cacheable = []; //The included methods can be cached. If no methods included, any method can be cached.
	    protected $cacheExcept = []; //The included methods can not be cached.	
		public $resource = 'posts';
	}
	
	$repo = new JsonPlaceholderPostsRepository();
	$posts = $repo->cache()->all();
	
	// $repo->cache()->all() is now cached.

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
	$sdk = new HttpSdk('http://example.com/api/', ['Authorization' => 'password123']);
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
