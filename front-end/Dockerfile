FROM node:16 as builder
WORKDIR /app
COPY package.json .
RUN yarn install
COPY . .
RUN yarn run build --prod

FROM nginx
COPY --from=builder /app/dist/front-end /usr/share/nginx/html