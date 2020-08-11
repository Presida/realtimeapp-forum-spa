class Token {
    isValid(token) {
        const payload = this.payLoad(token)
        if(payload) {
                return payload.iss == "http://localhost:8000/api/auth/login" ? true : false
        }
        return false
    }

    payLoad(token) {
        const payload = token.split('.')[1]
        return this.decode(payload)
    }

    decode(payload) {
        return JSON.parse(atob(payload))
    }
}

export default Token = new Token()
