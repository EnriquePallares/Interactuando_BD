const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const EventSchema = new Schema({
    title: { type: String, required: true },
    start: { type: String, required: true },
    start_hour: { type: String, required: false },
    end: { type: String, required: false },
    end_hour: { type: String, required: false },
    allDay: { type: Boolean, required: true },
    userId: { type: String, required: true },
});

module.exports = mongoose.model('Event', EventSchema);