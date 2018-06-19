# WheelEvent

## Invalid Request

### Request

```
> GET /invalid HTTP/1.1
```

### Response

```
< HTTP/1.1 400 Bad Request
< {"success":"false","definition":"Not Found"}
```

## Valid Request

### Request

```
> GET / HTTP/1.1
```

### Response

```
< HTTP/1.1 200 OK
< {
<   "class":"Controller\\RestController",
<   "method":"Controller\\RestController::get"
< }
```

## Forbidden request

### Request

```
> GET /protected HTTP/1.1
```

### Response

```
> {
>   "success":"false",
>   "definition":"Forbidden"
> }
```

## Get Protected route:

> curl http://localhost:8001/protected -H 'Authorization: Wheel Value'
