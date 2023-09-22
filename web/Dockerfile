# develop stage
FROM node:20.7.0-alpine as develop-stage
WORKDIR /usr/src/app
COPY . .

# build stage
FROM develop-stage as build-stage
RUN npm build

# production stage
#FROM nginx:1.15.7-alpine as production-stage
#COPY --from=build-stage /app/dist /usr/share/nginx/html
#EXPOSE 80
#CMD ["nginx", "-g", "daemon off;"]
