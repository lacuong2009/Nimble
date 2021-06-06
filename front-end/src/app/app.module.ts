import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {AuthComponent} from './auth/auth.component';
import {KeywordComponent} from './keyword/keyword.component';
import {RegisterComponent} from './register/register.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {MainLayoutComponent} from "./shared/layouts/main-layout.component";
import {CommonModule} from "@angular/common";
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import {ToastrModule} from "ngx-toastr";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {TokenInterceptor} from "./auth/token.interceptor";
import {KeywordDetailComponent} from "./keyword/details/keyword.detail.component";
import {KeywordUploadComponent} from "./keyword/upload/keyword.upload.component";
import {ProfileComponent} from "./auth/profile/profile.component";
import {NgProgressModule} from "ngx-progressbar";
import {NgProgressHttpModule} from "ngx-progressbar/http";

@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    KeywordComponent,
    RegisterComponent,
    MainLayoutComponent,
    KeywordDetailComponent,
    KeywordUploadComponent,
    ProfileComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    CommonModule,
    HttpClientModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    NgProgressHttpModule,
    NgProgressModule.withConfig({
      color: "red"
    }),
    ToastrModule.forRoot({
      positionClass: 'toast-bottom-right'
    }),
    NgbModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptor,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
