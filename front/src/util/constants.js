export function defaultHeaders() {
    var token = localStorage.getItem("token")
    return {
      "Content-Type": "application/json",
      Authorization: "Bearer " + token,
      Accept: "application/json"
    }
  }