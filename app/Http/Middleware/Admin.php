<?php

namespace App\Http\Middleware;

use App\Http\Controllers\BaseController;
use Closure;
use Illuminate\Http\Request;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\UploadedFileFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laravel\Passport\Http\Middleware\CheckCredentials;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use PHPUnit\Framework\Exception;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
class Admin implements AuthenticatesRequests
{
   protected $auth;

   /**
    * Create a new middleware instance.
    *
    * @param  \Illuminate\Contracts\Auth\Factory  $auth
    * @return void
    */
   public function __construct(Auth $auth)
   {
       $this->auth = $auth;
   }

   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string[]  ...$guards
    * @return mixed
    *
    * @throws \Illuminate\Auth\AuthenticationException
    */
   public function handle($request, Closure $next, ...$guards)
   {
       try{
       $this->authenticate($request, $guards);

       return $next($request);
       }catch(Exception $e){
           $b=new BaseController;
         return $b->sendError('some think error');
       }
     
   }

   /**
    * Determine if the user is logged in to any of the given guards.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  array  $guards
    * @return void
    *
    * @throws \Illuminate\Auth\AuthenticationException
    */
   protected function authenticate($request, array $guards)
   {
       if (empty($guards)) {
           $guards = [null];
          
       }

       foreach ($guards as $guard) {
           if ($this->auth->guard($guard)->check()) {
               return $this->auth->shouldUse($guard);
           }
       }

       $this->unauthenticated($request, $guards);
   }

   /**
    * Handle an unauthenticated user.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  array  $guards
    * @return void
    *
    * @throws \Illuminate\Auth\AuthenticationException
    */
   protected function unauthenticated($request, array $guards)
   {
       throw new AuthenticationException(
           'Unauthenticated.', $guards, $this->redirectTo($request)
       );
   }

   /**
    * Get the path the user should be redirected to when they are not authenticated.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return string|null
    */
   protected function redirectTo($request)
   {
       //
   }
}
