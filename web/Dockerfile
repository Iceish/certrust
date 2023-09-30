# develop stage
FROM node:20.7.0-alpine as develop-stage
WORKDIR /usr/src/app
COPY . .
RUN npm install

# build stage
FROM develop-stage as build-stage
ENV NODE_ENV=production
RUN npm run build

# production stage
FROM nginx:1.25.2-alpine as production-stage
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /usr/src/app/dist /usr/share/nginx/html
EXPOSE 3000
CMD ["nginx", "-g", "daemon off;"]
