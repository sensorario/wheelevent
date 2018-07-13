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

> curl -v localhost:8001/login -d '{"username":"admin","password":"password"}'
< HTTP/1.1 200 OK
{"token":"|#vtfsobnf#;#benjo#-#qbttxpse#;#qbttxpse#-#bvuifoujdbufe#;usvf~"}
