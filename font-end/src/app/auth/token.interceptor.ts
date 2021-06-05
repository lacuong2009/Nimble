import {Injectable} from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor, HttpErrorResponse, HttpResponse
} from '@angular/common/http';
import {catchError, finalize, switchMap, tap} from "rxjs/operators";
import {BehaviorSubject, Observable, of, throwError} from 'rxjs';
import {AuthService} from "./auth.service";

@Injectable()
export class TokenInterceptor implements HttpInterceptor {
  constructor(private authService: AuthService) {
  }

  public getToken(): string | null {
    return sessionStorage.getItem('access_token');
  }

  private logout() {
    this.authService.logout();
    window.location.href = '/';
  }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    request = request.clone({
      setHeaders: {
        Authorization: `${this.getToken()}`
      }
    });

    return next.handle(request).pipe(
      catchError(error => {
        this.logout();
        return throwError(error);
      }),
    );
  }
}
