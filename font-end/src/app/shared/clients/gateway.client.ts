import { Injectable } from '@angular/core';
import {BaseClient} from "./base.client";
import {environment} from "../../../environments/environment";

@Injectable({
  providedIn: 'root',
})
export class GatewayClient extends BaseClient {
  api = environment.gateway.url;
  apiKey = '';
}
