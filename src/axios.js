import axios from 'axios';

const instance = axios.create({
    // 设置baseURL，可以将所有请求的URL设置为相对路径，方便统一管理
    baseURL: "http://localhost/",
    // 设置请求头，例如Authorization、Content-Type等等
    headers: {
        'Authorization': "Bearer " + JSON.parse(sessionStorage.getItem("Token")),
        'Content-Type': 'application/json'
    },
    // 设置请求超时时间
    timeout: 10000,
    // 添加请求拦截器
    //   interceptors: {
    //     request: (config) => {
    //       // 在请求被发送之前做些什么
    //       return config;
    //     },
    //     response: (response) => {
    //       // 对响应数据做点什么
    //       return response;
    //     }
    //   }
});

export default instance;