### Laravel Resourceable
Laravel Resourceable is a package allowing you to quickly access a model's array value from an Api Resource class.

```
$user = new User([...]);
return $user->toResourceArray();
```
This package will automatically look for the resource class defined in the `App\Http\Resources` namespace with your **ClassName** + **Resource** appended. So for our user example, it would resolve to `App\Http\Resources\UserResource`. 

 You may also use a custom API Resource class from any namespace as a parameter:
```
return $user->toResourceArray(AlternateResource::class);
```

#### Why?

This allows for very accurate API HTTP testing of an endpoint, for example:

```
// UserTest.php
$user = factory(\App\User::class)->create();

$this->get(route('users.show'))
      ->assertJson($user->toResourceArray());
```

#### Credit
This package was written by Chris Arter with valuable contributions by [Dan Alverez](https://github.com/bayareawebpro)
