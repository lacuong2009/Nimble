import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {AuthComponent} from "./auth/auth.component";
import {KeywordComponent} from "./keyword/keyword.component";
import {RegisterComponent} from "./register/register.component";
import {MainLayoutComponent} from "./shared/layouts/main-layout.component";
import {
  AuthGuardService as AuthGuard
} from "./auth/auth.guard.service";
import {KeywordDetailComponent} from "./keyword/details/keyword.detail.component";

const routes: Routes = [
  {
    path: '',
    component: MainLayoutComponent ,
    children: [
      { path: '', component: KeywordComponent },
      { path: 'keyword', component: KeywordComponent },
      { path: 'keyword/:id', component: KeywordDetailComponent },
    ],
    canActivate: [AuthGuard]
  },
  { path: 'login', component: AuthComponent },
  { path: 'register', component: RegisterComponent },
  { path: '**', redirectTo: '' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
