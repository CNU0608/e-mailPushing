# Laravel5.3中Mailable发送邮件新特性

> 在laravel更早之前的版本中，实现邮件发送功能是很容易的一件事情，但是在Laravel5.3之后，感觉邮件发送功能变得更加人性化、nice了，实现起来还要简单。好啦！废话不多扯直接开车吧。。

在laravel5.3之后，laravel为我们提供了mail类，连接数据库后，我们可以通过
```php
    $ php artisan make:mail welcomeToMail
```
创建mail类完成之后，在`app/`目录下我们看到`Mail/welcomeToMail.php`就已经创建出来了，如下
```php
<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class welcomeToMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome');    //这里路径稍有不同，因为我改了，往下要用到
    }
}

```
OK，接下来我们就要配置咱们的`mail.php`,文件位于`config/mail.php`目录下,配置发送者如下，邮箱就用自己使用的邮箱就行啦
```php
 'from' => [
        'address' => env('XXXXX@qq.com', 'hello@example.com'),
        'name' => env('Fe', 'Example'),
    ],
```
配置完成之后，我们还缺邮箱转发商啦，要不然怎么发邮件啊，这里我用官方推荐的[mailtrap](https://mailtrap.io "mailtrap"),进去注册个就能用啦，注册成功登录后进入到官方免费为我们提供的`Demo inbox`，进去后复制咱们的用户名和密码到项目中的`.env`数据库配置文件中，如下
```php
MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=XXXXXXXX
MAIL_PASSWORD=XXXXXXXX
MAIL_ENCRYPTION=null
```
配置完成后，创建咋们的视图文件和路由，在`resources/view`文件下创建`email/welcome.blade.php`文件，如下：

```php
`<!doctype html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport"
           content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>
     <h1>hello, happy,hacking</h1>
     <p>在laravel的世界里你会发现无穷的乐趣。。</p>
 </body>
 </html>
```
创建路由，在`routes/web.php`文件下，如下：
```php
<?php
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    Mail::to('734***379@qq.com')->send(new \App\Mail\welcomeToMail());
});
```
好啦，最后运行`php artisan serve`跑起咋们的项目
```php
    $ php artisan serve
```
浏览器运行`localhost:8000`成功之后来到`https://mailtrap.io/inboxes`网站当中就可以看到邮件就发送到`734***379@qq.com`邮箱上去了，好啦，今期分享的内容就这些。关于获取数据库信息渲染到邮件当中的具体配置就`git`下本期上传到github的项目吧！

晚安，happy，hacking！




