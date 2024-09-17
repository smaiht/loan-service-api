# Loan Service API (Yii2, PostgreSQL, Nginx, Docker)

Time Spent: 3h


### Installation

INSTALLATION
------------

# 1. Using Docker

Clone this repository and set up the environment:
~~~
git clone https://github.com/smaiht/loan-service-api.git
~~~

Build and run the Docker containers:
~~~
cd loan-service-api/
docker-compose up --build
~~~
Open [http://localhost:8009/](http://localhost:8009/)

By default there are 20 random fake users created, so user_id can be 1-20, anything else will result in error.

DB can be accessed on localhost:54329, name=yii2_api_loan, user=root, password=12121212