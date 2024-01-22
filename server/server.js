// server.js
const express = require('express');
const bodyParser = require('body-parser');
const apiRoutes = require('./api');

const app = express();
const PORT = 3001;

app.use(bodyParser.json());

app.use('/api', apiRoutes);

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
