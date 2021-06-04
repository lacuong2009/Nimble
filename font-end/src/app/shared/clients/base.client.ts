import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {Injectable} from "@angular/core";

@Injectable({
  providedIn: 'root',
})
export class BaseClient {
  public api: any;
  public apiKey: any;

  public constructor(public http: HttpClient) {
  }

  public get<T>(endPoint: string, options : any): Observable<T> {
    return this.http.get<T>(this.api + endPoint, this.mergeHeaderOptions(options));
  }

  public post<T>(endPoint: string, params: Object, options? : any): Observable<T> {
    return this.http.post<T>(this.api + endPoint, params, this.mergeHeaderOptions(options));
  }

  public put<T>(endPoint: string, params: Object, options? : any): Observable<T> {
    return this.http.put<T>(this.api + endPoint, params, this.mergeHeaderOptions(options));
  }

  public delete<T>(endPoint: string, options? : any): Observable<T> {
    return this.http.delete<T>(this.api + endPoint, this.mergeHeaderOptions(options));
  }

  public request<T>(method: string, endPoint: string, params: any, options : any): Observable<T> {
    const opt: any = this.mergeHeaderOptions(options);

    if (params) {
      opt.body = params;
    }

    return this.http.request<T>(method, this.api + endPoint, this.mergeHeaderOptions(opt));
  }

  private mergeHeaderOptions(options = {headers: {}}) {
    const defaultOptions = {
      'headers': {
        'X-ApiKey': this.apiKey
      }
    };

    if (!options['headers']) {
      options['headers'] = {};
    }

    options['headers'] = Object.assign(options['headers'], defaultOptions.headers);

    return options;
  }
}
