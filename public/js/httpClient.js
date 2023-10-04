class HttpClient {
    async promiseAjax(url, payload,method) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.onload = () => {
                try {
                    const jsonResponse = JSON.parse(xhr.responseText);
                    resolve(jsonResponse);
                } catch (e) {
                    reject(e);
                }
            };

            xhr.onerror = () => {
                reject(new Error("Fetch error"));
            };

            const usedMethod = method || "GET";
            const params = new URLSearchParams(payload).toString();
            xhr.open(
                usedMethod,
                usedMethod !== "GET" ? url : payload ? `${url}?${params}` : url
            );
            xhr.setRequestHeader("Content-type", "application/json");
            payload && usedMethod !== "GET" ? xhr.send(JSON.stringify(payload)) : xhr.send();
        });
    }

    async get(url, payload) {
        return await this.promiseAjax(url, payload, "GET");
    }

    async post(url, payload) {
        return await this.promiseAjax(url, payload, "POST");
    }

    async put(url, payload) {
        return await this.promiseAjax(url, payload, "PUT");
    }

    async delete(url) {
        return await this.promiseAjax(url, null, "DELETE");
    }
}
