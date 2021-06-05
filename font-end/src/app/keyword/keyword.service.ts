import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {GatewayClient} from "../shared/clients/gateway.client";

@Injectable({
  providedIn: 'root'
})
export class KeywordService {
  constructor(private http: HttpClient,
              private client: GatewayClient,
  ) {
  }

  public search(keyword?: string, page : number = 1, limit : number = 10) {
    let uri = '/api/keywords?' + 'page=' + page + '&limit=' + limit;

    if (keyword) {
      uri += '&keyword=' + keyword?.trim();
    }

    return this.client.get(uri);
  }

  public detail(id: number) {
    let uri = '/api/keywords/' + id ;
    return this.client.get(uri);
  }
}
