## Github-challenge

## Install
`$ git clone https://github.com/mohammadHamzeh/challenge.git `

Via Composer

`$ composer install`

## How to use
1-To receive packages starred by the user, send the username to the following path

`api/v1/get-stared-repositories/{username}`

And instead of the `{username}`, put the username you want

2-To save the tag for your repositories, method `Post` the request to the following path
This Path 

`api/v1/store_tag_repository`

Body Param 

    1- repository_id required
   
    2- tags required array 
    
3- To filter repositories based on tags, use the following path and submit the tags parameter

`api/v1/repositories/index`

Query Param
 
    1- tag optional the tag name 
    
    
You can implement your own filters in RepositoryFilter

appreciate the time you spend for me.
