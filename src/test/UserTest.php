<?php

namespace test\unittest;

use PHPUnit\Framework\TestCase;
require __DIR__ . "\..\src\User.php";
final class UserTest extends TestCase
{
    public function testClassConstructor()
{
    $user = new User(18, 'John');

    $this->assertSame('John', $user->name);
    $this->assertSame(18, $user->age);
    $this->assertEmpty($user->favorite_movies);
}
}
?>