import { TestBed, async } from '@angular/core/testing';
import {AppComponent} from "./app.component";

describe('AuthComponent', () => {
  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [
        AppComponent
      ],
    }).compileComponents();
  }));

  it('should create the app', async(() => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.debugElement.componentInstance;
    expect(app).toBeTruthy();
  }));

  it(`should have as title 'Nimble - Web Developer - Challenge'`, async(() => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.debugElement.componentInstance;
    console.log(app.title);
    expect(app.title).toEqual('Nimble - Web Developer - Challenge');
  }));
});
