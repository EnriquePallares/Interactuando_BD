const http = require('http'),
    session = require('express-session'),
    routerUser = require('./Routes/routesUser'),
    routerEvent = require('./Routes/routesEvent'),
    express = require('express');

const port = process.env.PORT || 3000,
    app = express(),
    Server = http.createServer(app);

// Database Connection
require('./database');

// Create user script
require('./create_user');

// Middlewares
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(session({
    secret: 'secret',
    resave: true,
    saveUninitialized: true
}));

// Routes
app.use(routerUser);
app.use('/events', routerEvent);

// Static files
app.use(express.static('client'));

// Server in listening
Server.listen(port, function () {
    console.log("Server is running on port: " + port);
});