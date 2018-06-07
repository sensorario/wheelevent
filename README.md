# WheelEvent

## Invalid Request

### Request

```
> GET /invalid HTTP/1.1
```

### Response

```
< HTTP/1.1 400 Bad Request
{"success":"false"}
```

## Valid Request

### Request

```
> GET / HTTP/1.1
```

### Response

```
< HTTP/1.1 200 OK
{"success":"true"}
```
