export function defaultHeaders() {
  var token = localStorage.getItem("token");
  return {
    "Content-Type": "application/json",
    Authorization: "Bearer " + token,
    Accept: "application/json",
  };
}

export function mapErrors(error) {
  var errorData = error.response.data.errors
  return Object.keys(errorData).reduce((previous, key) => {
    previous[key] = errorData[key][0]
    return previous
  }, {})
}
