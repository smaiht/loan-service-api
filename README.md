# Loan Service API (Yii2, PostgreSQL, Nginx, Docker)

Time Spent: 3h



INSTALLATION
------------

# Using Docker

Clone this repository and set up the environment:
~~~
git clone https://github.com/smaiht/loan-service-api.git
~~~

Build and run the Docker containers:
~~~
cd loan-service-api/
docker-compose up --build
~~~
The API will be available at [http://localhost:8009/](http://localhost:8009/)

## Usage

- The web interface on the main page provides an easy way to interact with the API.
- By default, there are 20 random fake users created, so user_id can be 1-20. Anything else will result in an error.
- Logs can be found in /runtime/logs/api.log
- To stop the Docker containers, use: `docker-compose down`

### API Endpoints

- POST /requests: Submit a loan request
- GET /processor: Process loan requests

Example:
~~~
curl -X POST http://localhost:8009/requests -H "Content-Type: application/json" -d '{"user_id": 1, "amount": 3000, "term": 30}'
~~~
~~~
curl -X GET "http://localhost:8009/processor?delay=5"
~~~

## Database Access

The PostgreSQL database can be accessed with the following credentials:
- Host: localhost
- Port: 54329
- Database name: yii2_api_loan
- User: root
- Password: 12121212
