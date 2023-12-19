# Lumen PHP Framework

## PHP developer (Laravel + REST API)
## Communications Microservice
## (Twitter channel)

Users subscribe to chat bots. Through these chat bots, we can send notifications and any other
information to users. As well as enter into a dialogue with users and receive the information we
need from them.

## Description

REST API microservice - Lumen + Swagger + Twitter SDK

## Software requirements

1. PHP 7.4 - 8.1
2. MySQL 8+
3. Composer
4. Git
5. Lumen 8+
6. Swagger 3

## Description of the methods/functionalities

 Twitter API credentials are located at the .env file


the user_id is passed via the headers, so there is a middleware that checks for that and throws an error if it sin't passed - Http/Middleware/ValidateHeaders.php


To decouple the system I created a ChannelService  and a ChannelServiceInterface which define a subscribe method that handles the subscription process for the specific channel, in  Services/Channel. I also created an additional service, TwitterChannelService which handles the login, send message and webhook communication with twitter


I have 4 controllers which uses the ChannelService via dependency injection.

ChannelController.php - allow users to subscribe to a channel using a channel_id

SubscribeController.php -  allow users to subscribe  

MessageController.php -  allow users to send a message . uses the ChannelService via dependency injection, and the user ID is passed in the request header.

WebhookController.php -  get the response from twitter but here am logging the information

I created some sample test cases.

## Description of the methods/functionalities

Download the zip file, rename the .env.local to .env then use composer update.

## To test locally
- To start the development server run in the terminal -  php -S localhost:9000 -t public

- ensure 'user-id' is used in the header

- send a POST to http://localhost:9000/api/v1/send-message
- send a POST to http://localhost:9000/api/v1/subscribe
- send a POST to http://localhost:9000/api/v1/subscribe-channel
- send a POST to http://localhost:9000/api/v1/webhook

## Limitation
I used the recent Twitter API v2 endpoints which has limited v1.1 endpoints (e.g. media post, oauth) only, hence the subscription (subscribe & subscribe-channel) throws a 500 with this message "You currently have access to a subset of Twitter API v2 endpoints and limited v1.1 endpoints (e.g. media post, oauth) only. If you need access to this endpoint, you may need a different access level. You can learn more here: https://developer.twitter.com/en/portal/product".
