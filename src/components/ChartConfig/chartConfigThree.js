export const data = {
    labels: ['蛋白质', '碳水化合物','脂肪','维生素'],
    datasets: [
        {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF','#DD1B16'],
            data: [30, 120, 20, 80]
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
