import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {AuthService} from "./auth.service";
import {ToastrService} from "ngx-toastr";
import {FormGroup} from "@angular/forms";

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss']
})
export class AuthComponent implements OnInit {
  public model: any = {};
  public submitted: boolean = false;
  public form: FormGroup = new FormGroup({});

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private authService: AuthService,
    private toastr: ToastrService
  ) {

  }

  ngOnInit(): void {

  }

  public onSubmit() {
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
          console.log(error);
          this.toastr.error('Login failed', 'ERROR');
        },
      );
  }
}
