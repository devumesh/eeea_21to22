# EEEA WEBSITE

## DATABASE
### Database name
- eeea

### Tables
- events

### Table - Events Structure
- id - INT primary key and auto increment
- date - DATE DEFAULT NOW()
- event_name - VARCHAR(200)
- academic_year - INT
- description - TEXT
- link - VARCHAR(100) DEFAULT NULL
- image - LONGBLOB
- event_date - DATE DEFAULT NULL

Click here to view the [Events Table](https://drive.google.com/file/d/19UJi4Xk6i8wE38icNfPb6sxecW6PcmxW/view?usp=sharing)