const Router = require('express').Router();
const User = require('../models/User');

Router.post('/login', async function (req, res) {
    const { user, pass } = req.body;
    const sessionUser = req.session;
    const Usuario = await User.findOne({ email: user });
    const UserID = Usuario._id;

    if (!Usuario) {
        res.send("Rechazado");
    } else {
        const match = await Usuario.matchPassword(pass);
        if (match) {    
            sessionUser.userId = UserID;
            res.send("Validado");
        } else {
            res.send("Rechazado");
        }
    }
});

module.exports = Router;