const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const bcrypt = require('bcryptjs');

const UserSchema = new Schema({
    nombre: { type: String, required: true },
    email: { type: String, required: true },
    password: { type: String, required: true },
    fNacimiento: { type: String, required: true }
});

UserSchema.methods.matchPassword = async function (password) {
    return await bcrypt.compare(password, this.password);
};

module.exports = mongoose.model('User', UserSchema);