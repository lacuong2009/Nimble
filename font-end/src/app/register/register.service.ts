import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {GatewayClient} from "../shared/clients/gateway.client";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  constructor(private http: HttpClient,
              private client: GatewayClient,
              ) {
  }

  public register(data: any) {
    return this.client.post('/oauth/register', data);
  }
}
