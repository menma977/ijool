onmessage = function (e) {
    const [cookie, url, timing = 10000] = e.data;
    let params = "";
    params += append("s", cookie);
    params += append("a", "GetBalance");
    params += append("Currency", "doge");

    function append(key, value) {
        return `${encodeURIComponent(key)}=${encodeURIComponent(value)}&`;
    }

    setInterval(() => {
        const request = new XMLHttpRequest();
        request.open("POST", url, true);
        request.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        request.onload = function () {
            const data = JSON.parse(this.responseText);
            data.status = this.status;
            postMessage(data);
        };
        request.send(params);
    }, timing);
};