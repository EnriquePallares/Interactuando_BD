const Router = require('express').Router();
const Event = require('../models/Event');

Router.get('/all', async function (req, res) {
    const Events = await Event.find({ userId: req.session.userId });
    res.send(Events);
});

Router.post('/new', async function (req, res) {
    const { title, start, end, start_hour, end_hour, allDay } = req.body;

    const newEvent = new Event({
        title: title,
        start: start,
        start_hour: start_hour,
        end: end,
        end_hour: end_hour,
        allDay: allDay
    });

    newEvent.userId = req.session.userId;
    await newEvent.save(function (err) {
        if (err) throw err;
        res.send(newEvent);
    });
});

Router.post('/update/:id', async function (req, res) {
    const { start, end } = req.body;
    const event = await Event.findById(req.params.id);

    if (event.userId == req.session.userId) {
        const updateEvent = await Event.findByIdAndUpdate(req.params.id, {
            start,
            end
        });

        res.send(updateEvent);
    }
});

Router.post('/delete/:id', async function (req, res) {
    const deleteEvent = await Event.findByIdAndDelete(req.params.id);
    res.send(deleteEvent);
});

module.exports = Router;