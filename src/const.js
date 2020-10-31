import Noty from "@/../node_modules/noty/lib/noty.js"

export const notify = function(text, type = 'success') {
  new Noty({
    theme: 'metroui',
    text: '<b style="font-size: 1.2rem;">'+ text +'</b>',
    type: type,
    timeout: 1000
  }).show();
};

export const defaultParams = {
  path: "http://gasbank.creativityprojectcenter.ru/"
};

export const log = function (text) {
  if (process.env.NODE_ENV !== 'production')
    // eslint-disable-next-line no-console
    console.log(text);
};

import axios from 'axios';

export const send = axios.create({
  baseURL: defaultParams.path + "api/",
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
});
