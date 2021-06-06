import { Component, ElementRef, OnInit } from '@angular/core';
import {ActivatedRoute, NavigationEnd, Router} from "@angular/router";
import {AuthService} from "../../auth/auth.service";

@Component({
  selector: 'x-layout',
  templateUrl: './main-layout.component.html',
  styleUrls: ['./main-layout.component.scss']
})
export class MainLayoutComponent implements OnInit {

  public active:string = '';

  constructor(
    public el: ElementRef,
    private router: Router,
    private authService: AuthService
  ) {
    router.events.subscribe((event: any) => {
      if(event instanceof NavigationEnd) {
        let url = event.url;
        this.setActiveItem(url);
      }
    });
  }

  ngOnInit() {
  }

  ngOnDestroy() {
  }

  public setActiveItem(url: string)
  {
    if (url.indexOf('keyword') != -1 || url.indexOf('/') != -1) {
      this.active = 'keyword';
    } else if (url.indexOf('register') != -1) {
      this.active = 'register';
    } else if (url.indexOf('profile') != -1) {
      this.active = 'profile';
    }
  }

  public logout() {
    this.authService.logout();
    window.location.href = '/';
  }
}
