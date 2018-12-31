# FireMobile-SMS

[Fire Mobile](http://www.fire-mobile.com/) SMS Channel for Laravel.

## Install
```
composer require sykez/firemobile-sms
```

### Add the following environment variables to your environment (`.env` file)
```
FM_URL=https://<url>
FM_USERNAME=<username>
FM_PASSWORD=<password>
```

### Add the following configuration variables to `config\services.php`
```
  'fmsms' => [
	'url' => env('FM_URL'),
	'username' => env('FM_USERNAME'),
	'password' => env('FM_PASSWORD'),
	'from' => env('FM_FROM', 'Application Name'),
  ],
```

### Then send SMS through notification
```
    public function toSms($notifiable)
    {
        return (new SmsMessage)
            ->content("Welcome to My Company!.");
    }
```