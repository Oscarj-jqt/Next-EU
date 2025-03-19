# EU Talents

## Start container

```bash
    docker compose up -d
```

## User Management
- Following
- Register
- Login

### Details
- Password
- Username
- Country (Creator)
- Profile Picture


## Short videos 
- Swiping
- Like & Dislike
- Sharing von Videos

# DB

### Rel ratings

- user_id
- type
- created_at


/api/create-quiz
country, user_hash
=> success/failure

/api/get-question
quiz_connection_id
=> quiz_question_data

/api/validate-answer
quiz_question_id, answer
=> correct/wrong, (if correct) next quiz_question_id


### QuizQuestion

- id
- question_url
- question_content
- country
- wrong_answer_options
- correct_answer_options
- created_at

### QuizQueue

- id
- user_id
- search_country
- created_at

### QuizConnections

- id
- user_id
- user_id
- quiz_question_ids
- created_at
