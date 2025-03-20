FROM node:20-alpine AS builder

WORKDIR /app

COPY frontend .

RUN npm ci --only=production

RUN npm run build

FROM nginx:alpine

RUN rm /etc/nginx/conf.d/default.conf
COPY frontend/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

COPY --from=builder /app/dist ./

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
