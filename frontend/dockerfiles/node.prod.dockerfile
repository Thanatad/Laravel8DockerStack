FROM node:lts-alpine as builder

WORKDIR /usr/app

COPY ./package.json .
RUN mkdir -p node_modules/.cache && chmod -R 777 node_modules/.cache
RUN npm install --silent
COPY ./. .
RUN npm run build

FROM nginx:stable-alpine
EXPOSE 80
COPY --from=builder /usr/app/build /usr/share/nginx/html