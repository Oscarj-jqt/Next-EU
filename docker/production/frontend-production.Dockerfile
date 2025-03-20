FROM node:20-alpine

WORKDIR /usr/src/app

COPY frontend .
RUN npm i

RUN npm run build

EXPOSE ${PORT}

CMD ["npm", "start"]
