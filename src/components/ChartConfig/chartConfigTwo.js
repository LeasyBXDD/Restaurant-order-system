export const data = {
    labels: ['蛋白质', '碳水化合物'],
    datasets: [
        {
            backgroundColor: ['#41B883','#DD1B16'],
            data: [80, 8]
        }
    ]
}

export const options = {
    responsive: true,
    maintainAspectRatio: false
}

// 获取MyInfoView.vue中返回的数据
// export const getMyInfoViewData = (data) => {
//     return axios({
//         url: "/api/MyInfoView",
//         method: "get",
//         params: data
//     })
// }
