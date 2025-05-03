const express = require('express');
const app = express();

// Если в будущем понадобятся REST-эндпоинты:
app.use(express.json());

module.exports = app;
