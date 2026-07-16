/* Thêm vào file CSS tổng của bạn hoặc thẻ <style> layout */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500&display=swap');

:root {
    --color-agu-blue: #0066b3;
    --color-agu-green: #00954d;
    --color-agu-yellow: #ffe600;
    --color-agu-red: #ed1c24;
}

body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 15px;
    line-height: 1.5;
    color: #333333;
}

h1, h2, h3, h4, h5, h6, .font-heading {
    font-family: 'Montserrat', sans-serif;
}

h1 { font-size: 24px; font-weight: 700; }
h2 { font-size: 18px; font-weight: 600; }

/* Hiệu ứng gạch chân trượt cho Menu (Underline Slide-in) */
.menu-hover-effect {
    position: relative;
}
.menu-hover-effect::after {
    content: '';
    position: absolute;
    width: 100%;
    transform: scaleX(0);
    height: 3px;
    bottom: 0;
    left: 0;
    background-color: var(--color-agu-yellow);
    transform-origin: bottom right;
    transition: transform 0.3s ease-out;
}
.menu-hover-effect:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

/* Hiệu ứng Hover Smooth cho nút bấm */
.btn-agu-effect {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.btn-agu-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
