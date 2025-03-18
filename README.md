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

## Users

- id
- username
- password
- country
- profile_picture
- created_at

### Videos

(cdn)

- id
- title
- description
- thumbnail
- views
- country
- category
- created_at

### Rel uploaded_videos

- user_id
- video_id
- created_at

### Rel ratings

- user_id
- type
- created_at

### Rel saved_videos

- user_id
- video_id
- created_at
