FROM node:lts-alpine

WORKDIR /usr/app

COPY ./package.json .
RUN mkdir -p node_modules/.cache && chmod -R 777 node_modules/.cache
RUN npm install --silent
COPY ./. .

CMD ["npm","run","start"]
