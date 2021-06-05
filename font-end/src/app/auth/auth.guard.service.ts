import {CanActivate, Router} from "@angular/router";
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthGuardService  implements CanActivate {
  constructor(private route : Router) { }

  canActivate(){
    if(this.isAuthenticated()){
      return true;
    }

    this.route.navigate(['login']);
    return false;
  }

  /**
   *
   */
  public isAuthenticated() : boolean {
    let access_token = sessionStorage.getItem('access_token');
    return !!access_token;
  }
}
