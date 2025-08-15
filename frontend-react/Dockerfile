FROM node:18-alpine

# Set working directory
WORKDIR /app

# Add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# Copy package.json and package-lock.json
COPY package*.json ./

# Install app dependencies
RUN npm install --silent
RUN npm install react-scripts@5.0.1 -g --silent

# Copy app source
COPY . ./

# Expose port
EXPOSE 3000

# Start app
CMD ["npm", "start"]