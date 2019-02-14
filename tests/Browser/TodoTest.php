<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TodoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Laravel');
        });
    }
	
	public function testRegister()
	{
		$this->browse(function ($browser) {
			$browser->visit('register')
				->type('name', 'M. Irfan Afzal')
				->type('email', 'irfan@laravel.com')
				->type('password', 'password')
				->type('password_confirmation', 'password')
				->attach('userimage', '/Users/irfan/Downloads/pictures/References/Audace Carbon RF.jpg')
				->press('Register')
				->assertPathIs('/learn/laravel/todoapp/public/todo');
		});
	}
	
	public function testCreateTodo()
	{
		$this->browse(function ($browser) {
			$browser->visit('todo')
				->clickLink('Add Todo')
				->type('todo', 'Testing it With Dusk')
				->type('category', 'dusk')
				->type('description', 'This is created with dusk')
				->press('Add')
				->assertPathIs('/learn/laravel/todoapp/public/todo');
		});
	}
	
	public function testViewTodo()
	{
		$this->browse(function ($browser) {
			$browser->visit('todo')
				->assertVisible('#view1')
				->visit(
				$browser->attribute('#view1', 'href')
			)
				->assertPathIs('/learn/laravel/todoapp/public/todo/1')
				->clickLink('Edit')
				->type('description', 'Testing it with dusk again')
				->press('Update')
				->assertPathIs('/learn/laravel/todoapp/public/todo/1');
		});
	}
	
	public function testEditTodo()
	{
		$this->browse(function ($browser) {
			$browser->visit('todo')
				->assertVisible('#edit1')
				->visit(
					$browser->attribute('#edit1', 'href')
				)
				->type('description', 'Testing it with dusk again')
				->press('Update')
				->assertPathIs('/learn/laravel/todoapp/public/todo/1');
		});
	}
	
	public function testLogout()
	{
		$this->browse(function ($browser) {
			$browser->visit('/todo')
				->click('.navbar-user-links')
				->assertVisible('#logout')
				->clickLink('Logout')
				->assertPathIs('/learn/laravel/todoapp/public/');
		});
	}
	
	public function testLogin()
	{
		$this->browse(function ($browser) {
			$browser->visit('login')
				->type('email', 'irfan@laravel.com')
				->type('password', 'password')
				->press('Login')
				->assertPathIs('/learn/laravel/todoapp/public/todo');
		});
	}
	
	public function testDeleteTodo()
	{
		$this->browse(function ($browser) {
			$browser->visit('/todo')
				->assertVisible('#delete1')
				->clickLink('Delete')
				//->visit(
//					$browser->attribute('#delete1', 'href')
//				)
				->assertPathIs('/learn/laravel/todoapp/public//todo');
		});
	}
	
}
