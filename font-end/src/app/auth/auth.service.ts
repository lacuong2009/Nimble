import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {GatewayClient} from "../shared/clients/gateway.client";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient,
              private client: GatewayClient,
              ) {
  }

  public auth(user: string, password: string) {
    let data = {
      grant_type: "password",
      client_id: environment.gateway.clientId,
      client_secret: environment.gateway.clientSecret,
      username: user,
      password: password
    }

    return this.client.post('/oauth/token', data);
  }

  public logout() {
    return sessionStorage.clear();
  }
}
