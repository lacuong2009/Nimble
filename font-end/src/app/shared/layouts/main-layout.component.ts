import { Component, ElementRef, OnInit } from '@angular/core';

@Component({
  selector: 'x-layout',
  templateUrl: './main-layout.component.html'
})
export class MainLayoutComponent implements OnInit {
  constructor(
    public el: ElementRef,
  ) {
  }

  ngOnInit() {
  }

  ngOnDestroy() {
  }
}
