const User = require('./models/User');
const bcrypt = require('bcryptjs');
const salt = bcrypt.genSaltSync(10);
const hash = bcrypt.hashSync("1234", salt);

User.findOne({ email: "enrique@mail.com" }, function (err, doc) {
    if (err) throw err;

    if (doc) {
        console.log("El usuario ya fue registrado, puedes iniciar sesion");
    } else {
        let Usuario = new User({
            nombre: "Enrique Pallares",
            email: "enrique@mail.com",
            password: hash,
            fNacimiento: "1997-05-20"
        });

        Usuario.save(function (err) {
            if (err) throw err;
            console.log("Usuario registrado exitosamente, puedes iniciar sesion");
        });
    }
});