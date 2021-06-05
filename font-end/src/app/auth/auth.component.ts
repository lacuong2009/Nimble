import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {AuthService} from "./auth.service";
import {ToastrService} from "ngx-toastr";
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {AuthGuardService} from "./auth.guard.service";

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss']
})
export class AuthComponent implements OnInit {
  public model: any = {};
  public submitted: boolean = false;
  public form: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private authService: AuthService,
    private guardService: AuthGuardService,
    private toastr: ToastrService
  ) {

  }

  ngOnInit(): void {
    if (this.guardService.isAuthenticated()) {
      this.router.navigate(['/']);
    }

    this.form = new FormGroup({
      username: new FormControl('', Validators.required),
      password: new FormControl('', Validators.required)
    });
  }

  public onSubmit() {
    if (!this.form.valid) {
      if (!this.model.username) {
        this.toastr.warning('Username is required', 'WARN');
      }

      if (!this.model.password) {
        this.toastr.warning('Password is required', 'WARN');
      }

      return;
    }

    this.submitted = true;
    this.authService
      .auth(this.model.username, this.model.password)
      .subscribe(
        (data: any) => {
          sessionStorage.setItem('access_token', data.token_type + ' ' + data.access_token);
          sessionStorage.setItem('refresh_token', data.refresh_token);
          sessionStorage.setItem('expires_in', data.expires_in);

          this.toastr.success('Login successfully', 'SUCCESS');
          this.router.navigate(['/'], {queryParams: {'initAppAfterLogin': true}});
        },
        (error: any) => {
          this.toastr.error('Login failed', 'ERROR');
        },
      );
  }
}
